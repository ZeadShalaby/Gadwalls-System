<br/>
<p align="center">
  <a href="https://github.com/ZeadShalaby/Gadwalls-System">
          <img src="https://imgur.com/hcmFk7u.png?w=1600" alt="Logo" width="490" height="380">
    
  </a>

<h3 align="center"> Gadwalls System </h3>
<h3 align="center"> it's a project use different package like barryvdh/laravel-dompdf , endroid/qr-code </h3>

  <p align="center">
     Project Gadwalls System
    <br/>
    <br/>
  </p>
  
![Forks](https://img.shields.io/github/forks/ZeadShalaby/Gadwalls-System?style=social) ![Issues](https://img.shields.io/github/issues/ZeadShalaby/Gadwalls-System) ![License](https://img.shields.io/github/license/ZeadShalaby/Gadwalls-System)

## Table Of Contents

* [About the Project](#about-the-project)
* [Built With](#built-with)
* [Getting Started](#getting-started)
    * [Prerequisites](#prerequisites)
    * [Installation](#installation)
* [Usage](#usage)
    * [Locally](#running-locally)
    * [Via Container](#running-via-container)
* [Contributing](#contributing)
* [Authors](#authors)


<br>


</p>

## About The Project
it's a projects coded in Backend Laravel & blade .
Describe of the Project:
Gadwalls is a user-friendly cashier application for retail stores and restaurants. It streamlines sales and purchases by offering multiple payment options, generating invoices, and managing inventory in real-time. With sales reporting and customer management features, it helps businesses enhance efficiency and improve customer service.

## Built With

**Server:** Apache, Laravel

**Miscellaneous:** Github


## Getting Started

To get a local copy up and running follow these simple example steps.

### Prerequisites

* laravel

```sh
composer global require laravel/installer
```

Make sure that either **MySQL** or **MariaDB** are installed either manually or via **phpMyAdmin**

### Installation

Clone the project

```bash

https://github.com/ZeadShalaby/Gadwalls-System
```

Go to the project directory

```bash
  cd Gadwalls-System
```

Install dependencies

   - Run the following command to install the necessary packages:
     ```bash
     composer install
     ```
### Configure the Environment

1. **Create a `.env` File**:
   - Copy the `.env.example` file and rename it to `.env`:
     ```bash
     cp .env.example .env
     ```

2. **Generate an Application Key**:
   - Run the command:
     ```bash
     php artisan key:generate
     ```
     
4. **Configure Database Settings**:
   - Open the `.env` file in a text editor.
   - Set the following variables to match your database setup:
     ```plaintext
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=GadwallsDB
     DB_USERNAME=root
     DB_PASSWORD=
     ```
   - Adjust `DB_USERNAME` and `DB_PASSWORD` if needed.


### Set Up the Database

1. **Start XAMPP**:
   - Open the XAMPP Control Panel and start the Apache and MySQL services.


## Usage

### Running Locally

📌 Backend

Make the migrations to update the database

```bash
    php artisan migrate
```

Seed the Database

```bash
    php artisan db:seed
```

Start the server and run watch

```bash
    php artisan serve
```


go to the following route

```
    http://127.0.0.1:8000/
```
 

## Contributing

Any contributions you make are **greatly appreciated**.

* If you have suggestions for adding or removing projects, feel free
  to [open an issue](https://github.com/ZeadShalaby/Gadwalls-System/issues/new) to discuss it, or directly
  create a pull request after you edit the *README.md* file with necessary changes.
* Please make sure you check your spelling and grammar.
* Create individual PR for each suggestion.
* Make sure to add a meaningful description

### Creating A Pull Request

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/GoalFeature`)
3. Commit your Changes (`git commit -m 'Add some GoalFeature'`)
4. Push to the Branch (`git push origin feature/GoalFeature`)
5. Open a Pull Request



## Authors
* **Ziad Shalaby** - *Software Engineer* - [Ziad Shalaby](https://github.com/ZeadShalaby)


### Additional Tips

- If you encounter any issues, check your terminal for error messages and verify your `.env` settings.
- Ensure that the XAMPP services (Apache and MySQL) are running while you work on the project.
- Use Google or Stack Overflow for any errors or questions you may have.
- Refer to the [Laravel documentation](https://laravel.com/docs) for detailed information on Laravel features and usage.
- Text me if you have any questions or need help with the project.


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
