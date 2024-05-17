# Jukebox Technical Test - Lucas Ramos Domingues    

## How to run? (Linux) - Node and Composer required

### API
- `git clone git@github.com:PixeLarm12/jukebox-test.git`;
- `cd jukebox-test/api`;
- `composer install`;
- `cp .env.example .env`
- `./vendor/bin/sail up` or `sail up`
- In other terminal, run: `./vendor/bin/sail artisan key:generate` or `sail artisan key:generate`
- `./vendor/bin/sail artisan jwt:secret` or `sail artisan jwt:secret`
- `sail artisan migrate --seed` or `./vendor/bin/sail artisan migrate --seed`;
- You`ll see one user to login: 
    ``` 
        {
            name: 'Jukebox Admin',
            email: 'jukebox@admin.com',
            password: '123123',
        }
    ```

### Front
- Check if are into `/front` folder running `ls`;
- Open the terminal and run: `cd front` (if are necessary);
- `npm install`;
- `npm run build-css`;
- In other terminal, run: `npm run serve`;
- Now your application are running locally and ready to access at `localhost:8080` if no ports changed.
