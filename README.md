# Upfinzo Emi Processor

Step 1 : Clone the Project
```sh
git clone https://github.com/gangaiamaran/upfinzo-emi-processor.git
```

Step 2 : Install Dependencies
```sh
composer install
npm install
```

Step 3 : Build Assets
```sh
npm run build --prod
```

Step 4 : Migrate and Seed the Database
```sh
php artisan migrate --seed
```

## Raw Queries Used in EMI Processing

```php
# \App\Repository\LoanDetailRepository
public function rawQuery(): ?array
{
    return DB::select('SELECT * FROM loan_details');
}
```

```php
# \App\Repository\EmiDetailRepository
public function getMinMaxEmiDates(): array
{
    $dates = DB::table('loan_details')
        ->selectRaw(
            'MIN(first_payment_date) as min_first_payment_date, MAX(last_payment_date) as max_last_payment_date'
        )
        ->first();

    return [
        Carbon::parse($dates->min_first_payment_date),
        Carbon::parse($dates->max_last_payment_date),
    ];
}
```

```php
# \App\Services\EmiDetailMigrationService
DB::table('emi_details')->insert([
    'client_id' => $loan->client_id,
    ...$months,
]);
```
