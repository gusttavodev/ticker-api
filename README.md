## Setup

This project use Sail Docker, follow this steps to run

Execute
```
    composer install
```

Copy .env.example with .env

Up sail up sail
```
    sail up
```

Run migrations

```
    sail artisan migrate
```

Run horizon

```
    sail artisan horizon
```
Run schedule

```
    sail artisan schedule:run
```

## Runing tests
```
    sail artisan test
```

## Routes

Add headers: 
```json
    "Content-Type": "application/json",
    "Accept": "application/json"
```
---

```json
    "path": "/api/create-ticket",
    "method": "POST",
    "body": {
        "name": "Gustavo Silva",
        "numbers": [1,2,3,4,5,6]
    }
    "response": {
        "ticketCode": "4b205a5d-965c-455b-92aa-bb335cf2f61e"
    }
```
---
```json
    "path": "/api/ticket/{code}",
    "method": "GET",
    "params": {
        "code": "4b205a5d-965c-455b-92aa-bb335cf2f61e"
    }
    "response": {
        [
            {
                "id": 1,
                "name": "Gustavo Silva",
                "winner": 0,
                "code": "0ab14c18-8a6e-4c5d-8648-75faf6392abf",
                "numbers": "[1, 2, 3, 4, 5, 6]",
                "prize_id": null,
                "created_at": "2022-09-06T22:48:38.000000Z",
                "updated_at": "2022-09-06T22:48:38.000000Z"
            }
        ]
    }
```
