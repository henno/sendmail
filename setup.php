<?php

// This script generates missing files from examples

// Run composer install if vendor folder doesn't exist
if (!file_exists('vendor')) {
    echo "Installing dependencies...\n";
    exec('composer install');
}

// Create data folder if it doesn't exist
if (!file_exists('data')) {
    mkdir('data');
}

// Create contacts.csv file if it doesn't exist
if (!file_exists('data/contacts.csv')) {
    echo "Creating contacts.csv file...\n";
    copy('data/contacts.csv.example', 'data/contacts.csv');
}

// Create message.php file if it doesn't exist
if (!file_exists('data/message.php')) {
    echo "Creating message.php file...\n";
    copy('data/message.php.example', 'data/message.php');
}

// Create config.php file if it doesn't exist
if (!file_exists('config.php')) {
    echo "Creating config.php file...\n";
    copy('config.php.example', 'config.php');
}