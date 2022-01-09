VERSION := 1.2.0
PLUGINSLUG := customize-woo
PLUGINPATH := $(shell pwd)

install:
	composer install
	composer dump-autoload -o

clover.xml: install test

update_version:
	sed -i "s/@##VERSION##@/${VERSION}/" $(PLUGINSLUG).php
	sed -i "s/@##VERSION##@/${VERSION}/" inc/Config.php
	sed -i "s/@##VERSION##@/${VERSION}/" i18n/$(PLUGINSLUG).pot

remove_version:
	sed -i "s/${VERSION}/@##VERSION##@/" $(PLUGINSLUG).php
	sed -i "s/${VERSION}/@##VERSION##@/" inc/Config.php
	sed -i "s/${VERSION}/@##VERSION##@/" i18n/$(PLUGINSLUG).pot

unit: test

test: install
	bin/phpunit --coverage-html=./reports

build: install update_version
	mkdir -p build
	rm -rf vendor
	composer install --no-dev
	composer dump-autoload -o
	make copy
	zip -r $(PLUGINSLUG).zip $(PLUGINSLUG)
	rm -rf $(PLUGINSLUG)
	mv $(PLUGINSLUG).zip build/
	make remove_version

copy:
	mkdir $(PLUGINSLUG)
	cp -ar assets inc i18n vendor $(PLUGINSLUG)/
	cp customize-woo.php uninstall.php readme.txt license.txt $(PLUGINSLUG)/

dist: install update_version
	mkdir -p dist
	rm -rf vendor
	composer install --no-dev
	composer dump-autoload -o
	cp -r $(PLUGINPATH)/. dist/
	make remove_version

release:
	git stash
	git fetch -p
	git checkout master
	git pull -r
	git tag v$(VERSION)
	git push origin v$(VERSION)
	git pull -r

fmt: install
	bin/phpcbf --standard=WordPress . --ignore=assets,bin,i18n,vendor

lint: install
	bin/phpcs --standard=WordPress . --ignore=assets,bin,i18n,vendor

psr:
	composer dump-autoload -o

i18n: install
	wp i18n make-pot . i18n/$(PLUGINSLUG).pot --slug=$(PLUGINSLUG) --skip-js --exclude=vendor

cover: install
	bin/coverage-check clover.xml 100

clean:
	rm -rf vendor/
