## 
!!!!!!Архитектура и основные штуки для работы с пользователем взяты отсюда: https://github.com/ElisDN/demo-project-manager !!!!!!!!
# прототип социальной сети
Для ускорения разработки используется twig, symfony forms. Потом планирую сделать нормальный фронт, например на vue.
Бэк будет работать как rest api с каким-нибудь JWT token

Стэк
- symfony 5.3
- кэш - redis
- докер
- юнит-тесты (TDD)

В дальнейшем: 
- rabbitMQ для очередей
- elasticSearch
- сборка фронта и spa

Планируемая архитектура

- CQRS 
- команда - DTO, Handler - для обработки, CommandBus. 
- Запросы - через queryBus, без использования моделей - просто запросы с маппингов в DTO для отображения во фронт

## Пока сделано:

### элементы CQRS, а именно: регистрация и создание пользователя оформлены отдельными командами и разложены по UseCases
### DTO создания пользователя App\Model\User\UseCase\Create - получаем пока из формы, валидация внутри команды
### В handlere происходит обработка бизнес-логики, в handler инжектятся нужные сервисы
### Бизнес-логика  - в доменных моделях
### Для удобства вместо автоинкрементных ключей используются uuid
### Value Objects как типы для доктрины


