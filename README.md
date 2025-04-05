# URL Shortener

This is a simple URL shortening service built with Laravel. It provides two endpoints:

- `/api/encode` - Encodes a URL into a shortened URL
- `/api/decode` - Decodes a shortened URL back into the original URL

## Features

- Shorten a long URL into a short URL.
- Decode a short URL back to its original URL.
- Check for existing URLs to return the same short URL if the URL has already been shortened.

## Requirements

- PHP >= 8.2
- Composer
- Laravel >= 11

## Installation and Setup

Follow these steps to set up the project on your local machine.

### 1. Clone the repository

First, clone the repository to your local machine using `git`:

```bash
git clone https://github.com/jareerzeenam/atarim-tech-test.git
```
#### Navigate to the project directory
```bash
cd atarim-tech-test
```

### 2. Install dependencies
Install the required PHP packages using Composer:

```bash
composer install
```
### 3. Set up the environment
Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```
Make sure to set the correct database and cache configurations in your .env file, or configure the cache to use an in-memory store.

### 4. Generate the application key
Generate the application key using the following command:

```bash
php artisan key:generate
```

**Note**: This project uses in-memory cache by default, but you can switch to database storage if required.

### 5. Start the Local Development Server
You can start the local development server using the following command:

```bash 
php artisan serve
```
This will start the server at `http://localhost:8000`.

## Running Tests
To run the tests, use the following command:

```bash
php artisan test
```
Tests will check that the URL encoding and decoding functionalities work as expected.

---
## Testing with Postman
You can use Postman to test the API endpoints.
### 1. Encode a URL
- **Method**: POST
- **URL**: `http://localhost:8000/api/encode`
- **Body**: 
```json
{
    "url": "https://www.thisisalongdomain.com/with/some/parameters?and=here_too"
}
```
- **Response**: 
```json
{
    "short_url": "http://localhost:8000/f2912d"
}
```
### 2. Decode a URL
- **Method**: POST
- **URL**: `http://localhost:8000/api/decode`
- **Body**: 
```json
{
    "url": "http://localhost:8000/f2912d"
}
```
- **Response**: 
```json
{
    "original_url": "https://www.thisisalongdomain.com/with/some/parameters?and=here_too"
}
```
### 3. Test Invalid URLs
- **Method**: POST
- **URL**: `http://localhost:8000/api/decode`
- **Body**: 
```json
{
    "url": "http://localhost:8000/invalid"
}
```
- **Response**: 
```json
{
    "error": "URL not found"
}
```


