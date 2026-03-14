# Task Manager (Laravel + MySQL)

A task management backend built with Laravel 12 and MySQL.

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL 8+ (or MariaDB equivalent)
- Node.js 20+ and npm (for frontend assets)
- Tailwind CSS (via Vite)

## Prerequisites

Install these tools before setup:

- PHP 8.2 or newer
- Composer 2 or newer
- Node.js 20 or newer and npm
- MySQL server

## Setup

1. Go to the application directory.

```bash
cd task-manager
```

2. Install PHP dependencies.

```bash
composer install
```

3. Create your environment file.

Windows (PowerShell):

```powershell
Copy-Item .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

4. Configure database credentials in .env.

5. Generate app key.

```bash
php artisan key:generate
```

6. Run database migrations.

```bash
php artisan migrate
```

7. Install frontend dependencies.

```bash
npm install
```

8. Build assets (production build):

```bash
npm run build
```

Or run assets in watch mode during development:

```bash
npm run dev
```

9. Start the app.

```bash
php artisan serve
```

Open http://127.0.0.1:8000 in your browser.

## Useful Commands

- Full local bootstrap (uses composer script):

```bash
composer run setup
```

- Run full development process (server, queue, logs, vite):

```bash
composer run dev
```

- Run tests:

```bash
php artisan test
```

## Environment Variables

This section documents all environment variables used by this project, based on .env.example and all env() keys used in the current config files.

### Application

- APP_NAME: Application name used in UI labels and generated prefixes.
- APP_ENV: Runtime environment (example: local, production).
- APP_KEY: Laravel application encryption key.
- APP_DEBUG: Enables detailed debug error pages when true.
- APP_URL: Base URL for URL generation.
- APP_LOCALE: Default application locale.
- APP_FALLBACK_LOCALE: Fallback locale when a translation key is missing.
- APP_FAKER_LOCALE: Locale used by Faker for factories/seeding.
- APP_MAINTENANCE_DRIVER: Maintenance mode driver (example: file).
- APP_MAINTENANCE_STORE: Cache store for maintenance mode when using cache driver.
- APP_PREVIOUS_KEYS: Comma-separated previous app keys used for graceful key rotation.
- PHP_CLI_SERVER_WORKERS: Number of worker processes for PHP built-in server.
- BCRYPT_ROUNDS: Bcrypt cost factor (if hashing config uses it).

### Auth

- AUTH_GUARD: Default auth guard.
- AUTH_PASSWORD_BROKER: Password broker to use for reset flows.
- AUTH_MODEL: User model class for auth provider.
- AUTH_PASSWORD_RESET_TOKEN_TABLE: Password reset token table name.
- AUTH_PASSWORD_TIMEOUT: Password confirmation timeout in seconds.

### Logging

- LOG_CHANNEL: Default log channel.
- LOG_STACK: Comma-separated channels used by stack logger.
- LOG_DEPRECATIONS_CHANNEL: Channel for PHP deprecation warnings.
- LOG_DEPRECATIONS_TRACE: Include stack trace for deprecations when true.
- LOG_LEVEL: Minimum log level (debug, info, warning, error, etc).
- LOG_DAILY_DAYS: Days to keep daily log files.
- LOG_STDERR_FORMATTER: Monolog formatter class for stderr channel.
- LOG_SLACK_WEBHOOK_URL: Slack webhook URL for Slack log channel.
- LOG_SLACK_USERNAME: Username for Slack log messages.
- LOG_SLACK_EMOJI: Emoji/avatar for Slack log messages.
- LOG_PAPERTRAIL_HANDLER: Monolog handler class for Papertrail.
- LOG_SYSLOG_FACILITY: Syslog facility value.
- PAPERTRAIL_URL: Papertrail host.
- PAPERTRAIL_PORT: Papertrail port.

### Database

- DB_CONNECTION: Default DB driver (example: mysql).
- DB_URL: Full database connection URL override.
- DB_HOST: Database host.
- DB_PORT: Database port.
- DB_DATABASE: Database name.
- DB_USERNAME: Database username.
- DB_PASSWORD: Database password.
- DB_SOCKET: MySQL socket path (optional).
- DB_CHARSET: Database charset.
- DB_COLLATION: Database collation.
- DB_FOREIGN_KEYS: Enable foreign key constraints for sqlite.
- MYSQL_ATTR_SSL_CA: Path to MySQL CA certificate for SSL.
- DB_SSLMODE: SSL mode (notably for PostgreSQL).
- DB_ENCRYPT: SQL Server encryption setting.
- DB_TRUST_SERVER_CERTIFICATE: SQL Server trust certificate flag.

### Cache

- CACHE_STORE: Default cache driver/store.
- CACHE_PREFIX: Prefix applied to cache keys.
- DB_CACHE_CONNECTION: Database connection for database cache store.
- DB_CACHE_TABLE: Table name for database cache entries.
- DB_CACHE_LOCK_CONNECTION: Database connection for cache locks.
- DB_CACHE_LOCK_TABLE: Table name for cache locks.
- DYNAMODB_CACHE_TABLE: DynamoDB table for cache items.
- DYNAMODB_ENDPOINT: Custom DynamoDB endpoint.
- MEMCACHED_HOST: Memcached host.
- MEMCACHED_PORT: Memcached port.
- MEMCACHED_USERNAME: SASL username for Memcached.
- MEMCACHED_PASSWORD: SASL password for Memcached.
- MEMCACHED_PERSISTENT_ID: Persistent connection ID for Memcached.

### Session

- SESSION_DRIVER: Session storage driver.
- SESSION_LIFETIME: Session lifetime in minutes.
- SESSION_EXPIRE_ON_CLOSE: Expire session when browser closes.
- SESSION_ENCRYPT: Encrypt session data at rest.
- SESSION_CONNECTION: Database/Redis connection used by session store.
- SESSION_TABLE: Session table name when using database sessions.
- SESSION_STORE: Cache store used for session data.
- SESSION_PATH: Session cookie path.
- SESSION_DOMAIN: Session cookie domain.
- SESSION_SECURE_COOKIE: Send session cookie only over HTTPS.
- SESSION_HTTP_ONLY: Prevent JavaScript access to session cookie.
- SESSION_SAME_SITE: SameSite policy (lax, strict, none).
- SESSION_PARTITIONED_COOKIE: Enable partitioned cookies.

### Queue

- QUEUE_CONNECTION: Default queue driver.
- QUEUE_FAILED_DRIVER: Failed job storage driver.
- DB_QUEUE_CONNECTION: Database connection for queue driver.
- DB_QUEUE_TABLE: Jobs table name for database queue.
- DB_QUEUE: Queue name for database queue.
- DB_QUEUE_RETRY_AFTER: Retry-after seconds for database queue.
- REDIS_QUEUE_CONNECTION: Redis connection used by queue.
- REDIS_QUEUE: Queue name for Redis queue.
- REDIS_QUEUE_RETRY_AFTER: Retry-after seconds for Redis queue.
- BEANSTALKD_QUEUE_HOST: Beanstalkd host.
- BEANSTALKD_QUEUE: Beanstalkd queue name.
- BEANSTALKD_QUEUE_RETRY_AFTER: Retry-after seconds for Beanstalkd queue.
- SQS_PREFIX: SQS queue URL prefix.
- SQS_QUEUE: SQS queue name.
- SQS_SUFFIX: SQS queue URL suffix.

### Redis

- REDIS_CLIENT: Redis client (phpredis or predis).
- REDIS_URL: Full Redis URL override.
- REDIS_HOST: Redis host.
- REDIS_USERNAME: Redis username.
- REDIS_PASSWORD: Redis password.
- REDIS_PORT: Redis port.
- REDIS_DB: Redis DB index for default connection.
- REDIS_CACHE_DB: Redis DB index for cache connection.
- REDIS_CLUSTER: Redis cluster mode.
- REDIS_PREFIX: Key prefix for Redis keys.
- REDIS_PERSISTENT: Enable persistent Redis connections.
- REDIS_MAX_RETRIES: Maximum retry attempts.
- REDIS_BACKOFF_ALGORITHM: Retry backoff algorithm.
- REDIS_BACKOFF_BASE: Base delay for retry backoff.
- REDIS_BACKOFF_CAP: Max delay for retry backoff.
- REDIS_CACHE_CONNECTION: Redis connection name for cache.
- REDIS_CACHE_LOCK_CONNECTION: Redis connection name for cache locks.

### Mail

- MAIL_MAILER: Default mail transport.
- MAIL_SCHEME: Mail transport scheme.
- MAIL_URL: Full mail connection URL override.
- MAIL_HOST: SMTP host.
- MAIL_PORT: SMTP port.
- MAIL_USERNAME: SMTP username.
- MAIL_PASSWORD: SMTP password.
- MAIL_FROM_ADDRESS: Global from email address.
- MAIL_FROM_NAME: Global from display name.
- MAIL_EHLO_DOMAIN: EHLO/HELO domain for SMTP.
- MAIL_SENDMAIL_PATH: Sendmail binary/path options.
- MAIL_LOG_CHANNEL: Log channel when mailer is log.

### Filesystem and AWS

- FILESYSTEM_DISK: Default filesystem disk.
- AWS_ACCESS_KEY_ID: AWS access key.
- AWS_SECRET_ACCESS_KEY: AWS secret key.
- AWS_DEFAULT_REGION: AWS region.
- AWS_BUCKET: S3 bucket name.
- AWS_URL: Custom S3 URL.
- AWS_ENDPOINT: Custom S3-compatible endpoint.
- AWS_USE_PATH_STYLE_ENDPOINT: Use path-style endpoints when true.

### Third-Party Services

- POSTMARK_API_KEY: Postmark API key.
- POSTMARK_MESSAGE_STREAM_ID: Postmark message stream identifier.
- RESEND_API_KEY: Resend API key.
- SLACK_BOT_USER_OAUTH_TOKEN: Slack bot token.
- SLACK_BOT_USER_DEFAULT_CHANNEL: Default Slack channel.

### Frontend Build

- VITE_APP_NAME: Value exposed to Vite client build.

### Optional Legacy/Scaffold Variables

- BROADCAST_CONNECTION: Broadcast driver (used if broadcasting config is present).

