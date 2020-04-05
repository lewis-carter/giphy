# Giphy Task

## Set up

1. Clone the project `git clone https://github.com/lewis-carter/giphy.git`.
1. Create a `.env` by copying the the example file `cp .env.example .env`.
1. Generate an application key `php artisan key:genertate`.
1. Update the database environment details to your local database.
1. Run `php artisan migrate` to run migrations.
1. Serve the application with `php artian serve` or link the site if using Valet.

## Database Queries

My main consideration was to limit the amount of queries needed to perform a task. For instance the following statement would run one query to insert both records, rather than a query to insert each record.

```
DB::table('gifs')->insert([
	['title' => 'The Title', 'url' => 'https://giphy.gif'],
	['title' => 'The Title', 'url' => 'https://giphy.gif']
]);
```

Using [Debugbar](https://github.com/barryvdh/laravel-debugbar) to measure the speed of the queries inserting 100 records into the gifs table took ~28ms to complete, compared to individual queries which took ~160ms to complete.

Another simple optimisation was to use pagination to list the stored gifs. Instead of selecting all records from the database and handling pagination on the front end, the query was limited to 16 records.

## Testing

I wrote browser and database tests whilst working on the tasks. Before building out a feature I would write tests to ensure the page is displaying the correct content and that any database actions are working as expected. Since the task involved working with an API, I used model factories to mock the response of my Giphy class, so that testing doesn't hit the endpoint.

## Work Undertaken

### Task 1

Make a HTTP request to Giphy to retrieve trending gifs and display them on the homepage. These results are cached for an hour.

### Task 2

Added a search input on the navigation bar to make a HTTP request to Giphy to retrieve searched gifs. These results are cached for 1 minute.

### Tasks 3 & 4

Navigating to `/random` will make multiple a HTTP requests to Giphy to retrieve and display random gifs. These are stored into the gifs table. Then I select all gifs in that table that havn't been modified, append a timestamp to the gif's titles and store them into the modified gifs table.

### Tasks 5 & 6

Navigating to `/modified` will display a paginated list of all gifs in the modified gifs table. This page also has a basic search on the GIFs titles.
