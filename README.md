# URL Shortener
PurePHP test task for [KeyMakr.com](https://keymakr.com/)

## Task description
Could be found [here](TASK.md)

## Author's anwers and comments

1. URL shortener
- As I was forbidden to use existing frameworks I wrote my own small one from scratch (`MVC`) :)
- Wasn't sure I could use composer's autoload, so I also wrote my own :)
- Wasn't sure I could use external packages, so wrote own routing instead of requiring e.g. `symfony/routing`.
- I've used composer and it's autoload just for dev environment for making unit-tests, so no `vendor` on prod :)
- All code is mine except `App\Libs\Math` (written by `Laravel` creator), which performs simplest base62-10 and backwards converting (usually I just require `tuupola/base62`).
- Surely I used `Redis` instead of `*Sql` solutions to win the speed :) 
- My results on localhost (`unique urls`):
	- 100 submissions successfully completed in: 0.356 sec.
    - 1000 url accessed successfully in: 0.8724 sec.
	- both `10,000 URL submissions and 10,000,000 short URL accesses` are performed less, than in minute, but surely not less, than a second :)
- For the front I used `bootstrap`/`jQ` for the fast development :)

2. Scale
- As it was demanded I wrote it [here](SCALING.md)

3. Extras
- Docker file included
- Having just few commits here, initial, final, fix spaces and SCALING edit. That's it :)