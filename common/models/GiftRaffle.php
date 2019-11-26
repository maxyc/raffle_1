<?php

namespace common\models;

use common\models\contract\RaffleInterface;
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
     */
    public static function process(User $user): array
    {
        $availableEntities = Entity::find()->available()->select('id')->column();
        if (!$availableEntities) {
            throw new ErrorException('Available entities not found');
        }

        $randKey = array_rand($availableEntities);
        $entityId = $availableEntities[$randKey];
        $entity = Entity::findOne($entityId);

        $userEntity = static::offerToUser($entity, $user);
        if (!$userEntity) {
            throw new ErrorException('Error offer entity to user');
        } else {
            $entity->decrement();
        }

        return [
            'userEntity' => $userEntity
        ];
    }

    protected static function offerToUser(Entity $entity, User $user)
    {
        $userEntity = new UserEntity();
        $userEntity->entity_id = $entity->id;
        $userEntity->user_id = $user->id;

        if ($userEntity->save()) {
            return $userEntity;
        }

        return false;
    }
}