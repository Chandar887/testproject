**Setup**
1. Go to [localhost/phpmyadmin](localhost/phpmyadmin) and create a new Database naming: `test-project`

2. Open terminal, run `cd /var/www/html/box-react` and run the following commands in it:

    `php artisan key:generate`

3. Open `.env` file and update

    `DB_DATABASE=test-project`
    
    `DB_USERNAME=root`             // Change accordingly
    
    `DB_PASSWORD=root`             // For windows it may be empty or change accordingly
    
4. Run

    `git fetch`
    
    `git checkout master`
    
    `git pull origin master`
    
    `composer install`
    
    `php artisan migrate`
    
5. Serve the application using `php artisan serve`. Go to the browser, open: [localhost:8000](localhost:8000)

6. Click on "Hit API" link for save the news api's response in database.