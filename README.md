This application was designed to be a sample application for lorem article generation,
listing and statistics. Some parts of the code are not optimized and work slower,
than could be.

During the workshop, we will find the bottlenecks using profiler and fix them.

## Installation

1. Clone this repository
2. Run `composer install`
3. Run `./yii migrate/up` and apply the migration
4. Start a web server using `./yii serve`


## Running blackfire-player

See https://blackfire.io/docs/player/index#documentation for details:

```
blackfire-player run --blackfire-env "Test" -- tests/blackfire-player/smoke.bkf
```
