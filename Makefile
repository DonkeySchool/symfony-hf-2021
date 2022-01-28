.PHONY: help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

rebuild-propel: ## do propel Rebuild
	bin/console propel:database:drop --force
	bin/console propel:database:create
	bin/console propel:model:build
	bin/console propel:sql:build
	bin/console propel:sql:insert --force
	bin/console propel:fixtures:load -d src/Propel/fixtures

install-propel: ## do propel install
	bin/console propel:database:create
	make rebuild-propel
