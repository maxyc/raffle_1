<?php

namespace common\models;

use common\exceptions\EntityNotFoundException;
use yii\base\ErrorException;

class GiftRaffle implements RaffleInterface
{
    /**
     * @return bool
     */
    public static function isAvailable(): bool
    {
        return Entity::find()->available()->count() > 0;
    }

    /**
     * @param User $user
     * @return array
     * @throws ErrorException
     * @throws EntityNotFoundException
     */
    public static function process(User $user): array
    {
        $availableEntities = Entity::find()->available()->select('id')->column();
        if (!$availableEntities) {
            throw new EntityNotFoundException('Available entities not found');
        }

        $randKey = array_rand($availableEntities);
        $entityId = $availableEntities[$randKey];
        $entity = Entity::findOne($entityId);

        $userEntity = static::offerToUser($entity, $user);
        if (!$userEntity) {
            throw new ErrorException('Error offer entity to user');
        } else {
            $entity->updateCounters(['in_stock' => -1]);
        }

        return [
            'userEntity' => $userEntity
        ];
    }

    protected static function offerToUser(Entity $entity, User $user)
    {
        $userEntity = new UserEntities();
        $userEntity->entity_id = $entity->id;
        $userEntity->user_id = $user->id;

        if ($userEntity->save()) {
            return $userEntity;
        }

        return false;
    }
}