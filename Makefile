.DEFAULT_GOAL := help

help:
	@echo ""

deps:
	composer install --prefer-dist

unit:
	vendor/bin/phpunit --coverage-text --coverage-clover=coverage.xml --coverage-html=./report/

test: unit

.PHONY: help deps test