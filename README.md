### Laravel Setup Instructions README

```markdown
# Laravel Setup Instructions

### Migration
```bash
php artisan migrate
```

### Step 1: Generate Passport Keys
To set up Laravel Passport for API authentication, generate the encryption keys used for token creation and validation.

```bash
php artisan passport:keys
```

### Step 2: Create Personal Access Clients
After generating the keys, run the following command to create personal access clients for web and mobile:

```bash
php artisan passport:create-personal-access-clients
```

This command will create personal access clients for both **web** and **mobile**. The client IDs will be displayed in the terminal after creation.

### Step 3: Store Client IDs
1. **Store the Client IDs**:
    - After running the above command, make sure to store the generated Client IDs in the `.env` file of your mobile and web applications.
    - For example:
      ```dotenv
      # For Web Client
      PASSPORT_CLIENT_ID_WEB=your_web_client_id
 
      # For Mobile Client
      PASSPORT_CLIENT_ID_MOBILE=your_mobile_client_id
      ```

2. **Use Client IDs**:
    - Pass the respective Client ID in the header for login, registration, and OAuth endpoints.
    - For example, in your request headers:
      ```http
      Authorization: Bearer your_token
      client-id: your_client_id
      ```

### Step 4: Enable Required PHP Extensions for Laravel Excel
To use Laravel Excel, ensure the following PHP extensions are enabled in your `php.ini` file:

```ini
extension = gd
extension = zip
```

These extensions are necessary for handling image and ZIP file manipulations, which are required by Laravel Excel for exporting and importing data.
```

### Summary of Changes
1. **Step 2** has been updated to include the command for creating personal access clients.
2. **Step 3** explains how to store the generated Client IDs in the `.env` file and how to use them in API requests.
3. Added clarity to each step for better understanding.

Feel free to adjust any parts further or let me know if you need additional changes