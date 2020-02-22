start:
	composer install && npm install && npm run dev

test:
	vendor/bin/phpunit
