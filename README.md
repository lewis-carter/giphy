# Giphy Task

## Set up

1. Clone the project `git clone https://github.com/lewis-carter/giphy.git`.
2. Copy the `.env.example` file as `.env` by `cp .env.example .env`.
3. Generate an application key `php artisan key:genertate`.
4. Update the database environment details to your local database.
5. Run `php artisan migrate` to run migrations.
6. Serve the application with `php artian serve` or link the site if using Valet.

## Database Queries

My main consideration was to limit the amount of queries needed to perform a task. For instance the following statement would run one query to insert both records, rather than a query to insert each record.

```
DB::table('gifs')->insert([
	['title' => 'The Title', 'url' => 'https://giphy.gif'],
	['title' => 'The Title', 'url' => 'https://giphy.gif']
]);
```

Using [Debugbar](https://github.com/barryvdh/laravel-debugbar) to measure the speed of the queries inserting 100 records into the gifs table took ~28ms to complete, compared to individual queries which took ~160ms to complete.

Another simple optimisation was to use pagination to list the stored GIFs. Instead of selecting all records from the database and handling pagination on the front end, the query was limited to 16 records.

## Testing

## Work Undertaken
