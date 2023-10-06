# Send mass email to all users in a CSV file using PHPMailer

This is a simple PHP script to send mass email to all users in a CSV file using PHPMailer.

## Requirements

- PHP 7 or higher
- Composer installed
- A CSV file (see `data.csv.example` for an example)
- An SMTP server

## Installation

1. Run `php setup.php` to automatically install dependencies, generate `config.php`, and `data/contacts.csv` and `data/message.php` files.
2. Edit `config.php` and fill in the SMTP server details.
3. Edit `data/contacts.csv` and fill in the contacts details.
4. Edit `data/message.php` and fill in the message details.

## Usage
1. Run `php send.php` to send the emails.
