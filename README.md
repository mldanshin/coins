# My Coin collection
A website representing a collection of coins.  
The site is divided into parts:
- public;
- admin panel protected by login and password.
Through the admin panel, information about coins is added, data is changed, deleted.  
Through the public part of the site, you can view the collection of moents, but in a limited volume, some of the characteristics of the moents are available only to the admin panel.  
You can add an article and seo data for each coin.  

## Requirements
- PHP 8.0 or higher  
- Composer  
- Git  
- MySQL

## Installation
Clone the repository using git

    git clone https://github.com/mldanshin/coins

Install dependencies using composer

    composer install --optimize-autoloader --no-dev

Create a symbolic link:

    ln -s ../storage/app/public public/storage

Create a database with encoding utf8mb4_general_ci.  

Create a .env file based on the .env.example file, 

    cp .env.example .env

fill in the fields:

- APP_URL=

- DB_DATABASE=
- DB_USERNAME=
- DB_PASSWORD=

- MAIL_HOST=
- MAIL_PORT=
- MAIL_USERNAME=
- MAIL_PASSWORD=
- MAIL_FROM_ADDRESS=

- DANSHIN_COMMENT_MAIL_REPLAY_TO_ADDRESS= //email address of the message recipient for the 'comment' package

Read more about the comment package here: https://github.com/mldanshin/package-comment.

**Important! Filling in the specified fields in the file .env is a must!**

Perform the migration

    php artisan migrate

Seed the database with initial data

    php artisan db:seed

Create an administrator by filling in the user table in the database. **Note that the password must be hashed!*
For hashing, use the method make() the facade Illuminate\Support\Facades\Hash

    use Illuminate\Support\Facades\Hash;
    Hash::make("password");

Add commands to the task scheduler to delete temporary data, update the site map  
- comment:cut
- picture:clear
- sitemap:generate

## Usage
On the public part of the site, localizations are supported: en, ru, in the administrative panel only localization ru.  
So far, the creation of articles and seo data is supported only with ru localization.  
From the admin panel CRUD operations are possible only to the coin. CRUD operations with parameters describing the coin (for example, "country") are only possible directly with the database.  
Filtering and ordering of the coin collection is supported on the public part and the administrative panel. Text search is not implemented.  

### Console commands
- php artisan comment:clear //clears the comments file
- php artisan comment:cut //cuts comments from the file to the set size, sending the cut part to the email
- php artisan picture:clear //clears the temporary image storage directory
- php artisan sitemap:generate //generates a site map

## Testing
To run the tests, run  

    php artisan test

## Demo
https://demo-coins.danshin.net  
Login: user  
Password: demo  

## Contacts
mail@danshin.net

## License

Open source software licensed in accordance with [MIT license](https://opensource.org/licenses/MIT).
