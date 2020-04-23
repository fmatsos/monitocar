COMPOSER	   = composer
DEPENDENCY_BIN = yarn
DOCKER         = docker-compose
EXEC_PHP       = php
PROJECT		   = monitocar
SYMFONY        = $(EXEC_PHP) bin/console
SYMFONY_BIN    = symfony

.DEFAULT_GOAL = help
.PHONY: vendor assets install

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

install: vendor assets build ## Install application

## ——— Composer ———
composer.lock: composer.json
	$(COMPOSER) update

vendor-install: composer.lock ## Install vendors according to the current composer.lock file
	$(COMPOSER) install --no-suggest --prefer-dist --optimize-autoloader

vendor-update: composer.json ## Update vendors according to the composer.json file
	$(COMPOSER) update

vendor: vendor-install ## Install or update vendors automatically

## ——— Symfony ———
cert-install: ## Install the local HTTPS certificates
	$(SYMFONY_BIN) server:ca:install

start: ## Serve the application with HTTPS support
		$(SYMFONY_BIN) serve --daemon --port=8000

stop: ## Stop the webserver
	$(SYMFONY_BIN) server:stop

## ——— Assets ———
yarn.lock: package.json
	$(DEPENDENCY_BIN) install

assets-install: yarn.lock ## Install assets dependencies
	$(DEPENDENCY_BIN) install

assets-update: package.json ## Update assets dependencies
	$(DEPENDENCY_BIN) update

asserts: assets-install ## Install or update assets dependencies automatically

dev: ## Rebuild assets for the dev env
	$(DEPENDENCY_BIN) run encore dev

build: ## Build assets for production
	$(DEPENDENCY_BIN) run encore production --progress

watch: ## Watch files and build assets when needed for the dev env
	$(DEPENDENCY_BIN) run encore dev --watch

