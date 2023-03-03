# MVC (In Development)

MVC (Model-View-Controller) is a pattern in software design commonly used to implement user interfaces, data, and controlling logic. It emphasizes a separation between the software's business logic and display. This "separation of concerns" provides for a better division of labor and improved maintenance. Some other design patterns are based on MVC, such as MVVM (Model-View-Viewmodel), MVP (Model-View-Presenter), and MVW (Model-View-Whatever).

The three parts of the MVC software-design pattern can be described as follows:

- Model: Manages data and business logic.
- View: Handles layout and display.
- Controller: Routes commands to the model and view parts.

## The Model

The model defines what data the app should contain. If the state of this data changes, then the model will usually notify the view (so the display can change as needed) and sometimes the controller (if different logic is needed to control the updated view).

## The View

The view defines how the app's data should be displayed.

## The Controller

The controller contains logic that updates the model and/or view in response to input from the users of the app.

## Features

- [x] Custom Routing
- [x] Controllers
- [x] Views
- [ ] Models
- [ ] Migrations
- [ ] Form Widget Classes
- [ ] Processing of Request Data
- [ ] Validations
- [ ] Active Record
- [ ] Session Flash Messages
- [ ] Middlewares
- [x] Logs
- [ ] Application Events

## Dependencies

- [ ] PHP Dotenv
- [ ] PHPUnit (development)
- [ ] Twig

## CLI Commands

- [ ] composer run server (starts the app at localhost:3000)
- [ ] composer run tests (run all the tests in test directory)

## How to Install

You can clone the repository on your desktop or simply download the compressed file by clicking on Code and then Download ZIP.

```bash
git@github.com:AssoDePicche/mvc.git
```

To install the framework dependencies you must use the `composer install` command in your terminal.

```bash
composer install
```
