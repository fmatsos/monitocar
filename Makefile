COMPOSER	   = composer
DEPENDENCY_BIN = yarn
DOCKER         = docker-compose
EXEC_PHP       = php
PROJECT		   = monitocar
SYMFONY        = $(EXEC_PHP) bin/console
SYMFONY_BIN    = symfony

.DEFAULT_GOAL = help

## —— Commands ——————————————————————————————————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Composer 🧙‍——————————————————————————————————————————————————————————————
install: composer.lock ## Install vendors according to the current composer.lock file
	$(COMPOSER) install --no-progress --no-suggest --prefer-dist --optimize-autoloader

update: composer.json ## Update vendors according to the composer.json file
	$(COMPOSER) update

## —— Symfony 💻💻🧙💻‍——————————————————————————————————————————————————————————————
cert-install: symfony ## Install the local HTTPS certificates
	$(SYMFONY_BIN) server:ca:install

serve: symfony ## Serve the application with HTTPS support
	$(SYMFONY_BIN) serve --daemon --port=8000

stop: symfony ## Stop the webserver
	$(SYMFONY_BIN) server:stop

## —— Assets ‍——————————————————————————————————————————————————————————————
dev: ## Rebuild assets for the dev env
	$(DEPENDENCY_BIN) run encore dev

watch: ## Watch files and build assets when needed for the dev env
	$(DEPENDENCY_BIN) run encore dev --watch

build: ## Build assets for production
	$(DEPENDENCY_BIN) run encore production --progress