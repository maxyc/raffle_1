**Задание:**

Нужно разработать веб-приложение для розыгрыша призов. После аутентификации пользователь 
может нажать на кнопку и получить случайный приз. Призы бывают 3х типов: денежный (случайная 
сумма в интервале), бонусные баллы (случайная сумма в интервале), физический предмет 
(случайный предмет из списка).

Денежный приз может быть перечислен на счет пользователя в банке (HTTP запрос к API банка), 
баллы зачислены на счет лояльности в приложении, предмет отправлен по почте (вручную 
работником). Денежный приз может конвертироваться в баллы лояльности с учетом коэффициента. 
От приза можно отказаться. Деньги и предметы ограничены, баллы лояльности нет.

**Комментарии к реализации: **

• Не нужно реализовывать все, достаточно потратить максимум 2 часа и отобразить прогресс 
в git репозитории. Нам важно понять, как вы думаете.

• Готовое задание нужно отправить ссылкой на репозиторий.

• В данном задании оценивается не внешний вид приложения, а сам код, в связи с чем 
необходимо ориентироваться на code review, а не визуальную и функциональную оценку 
приложения

• Если вы претендуете на позию middle senior разработчика подготовьте решение - advanced -

• Срок выполнения задания +2 суток от момента получения. Если Вам нужно больше времени. 
Обратитесь к рекрутеру

**Решений 2:**

*- minimal-*

• Нужно предоставить прототип в PHP 5.6+ без использования фреймворков / или с ними, но 
можно использовать любые библиотеки. Где хранить данные - на ваше усмотрение.

• Нужно добавить консольную команду которая будет отправлять денежные призы на счета 
пользователей, которые еще не были отправлены пачками по N штук.

*-advanced-*

• Реализация с помощью фреймворка (можно любой, но лучше Yii или Yii2), использованием 
БД.

• Нужно добавить консольную команду которая будет отправлять денежные призы на счета 
пользователей, которые еще не были отправлены пачками по N штук.

• Добавить юнит-тест конвертирования денежного приза в баллы лояльности


**Желаем Вам удачи!**