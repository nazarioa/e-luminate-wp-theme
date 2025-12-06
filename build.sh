#!/bin/bash

rm -rf ./build
mkdir ./build

composer install --no-dev --optimize-autoloader --classmap-authoritative

rsync -a \
  --exclude='build.sh' \
  --exclude='composer.*' \
  --exclude='node_modules' \
  --exclude='.git*' \
  --exclude='.editorconfig*' \
  --exclude='tests' \
  --exclude='build' \
  ./ build/eluminate-hestia-child/

cd build
zip -rq eluminate-hestia-child.zip eluminate-hestia-child/
