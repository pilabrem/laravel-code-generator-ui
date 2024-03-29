
# Laravel code generator ui

## Introduction

User interface to help developpers with laravel-code-generator commands.
With this package combined to [crestapps/laravel-code-generator](https://github.com/CrestApps/laravel-code-generator), developpers can create easily their CRUD.
> You can visite [crestapps/laravel-code-generator](https://github.com/CrestApps/laravel-code-generator) repository to see how to set it up properly.

## Features

- Create table model
    - Enter model name
    - Enter table name (optional)
    - Generate migrations (optional)
    - Generate with form request (optional)
    - Generate with soft delete (optional)
    - Translations (optional)
    - Primary key if the primary key is not the id attribute (optional)
- Create table model attributes
    - Enter attribute name
    - Enter attribute labels (optional)
    - Enter attribute placeholder (optional)
    - Enter attribute laravel validation (optional)
    - Enter attribute Html Type (default: text)
    - Enter attribute database data type (default: string)
    - Enter attribute Data Type Params (optional)
    - Enter attribute Options: for select, radio, checkbox, ... (optional)
    - Enter attribute Date format: for Date, Datetime and DateTimeTz (optional)
    - Enter attribute Html Value (optional)
    - Enter attribute CSS class (optional)
    - Enter attribute Data value (optional)

## Installation

1. To download this package into your laravel project, use the command-line to execute the following command

	```
	composer require pilabrem/laravel-code-generator-ui --dev
	```

2. If don't have a layout, you can create one for your project with this command

	```
	php artisan create:layout "Your project name"
	```
 
3. **(You may skip this step when using Laravel >= 5.5)** To bootstrap the packages into your project , open the app/Providers/AppServiceProvider.php file in your project. Then, add the following code to the register() method.

	Add the following line to bootstrap laravel-code-generator to the framework.

	```
	    $this->app->register('CrestApps\CodeGenerator\CodeGeneratorServiceProvider');
	    $this->app->register('Pilabrem\CodeGeneratorUI\CodeGeneratorUiServiceProvider');
	```

4. Publish the package assets

    ```
    php artisan vendor:publish --provider="Pilabrem\CodeGeneratorUI\CodeGeneratorUiServiceProvider"
    ```

5. Now, you can migrate database

	```
	php artisan migrate
	```
 
## Usages

1. Manage tables models

    To manage your tables models, access to [yourHost/code-generator-ui/table](http://127.0.0.1:8000/code-generator-ui/table).

    After visiting the link, you can click on the plus and green button at the top to add a table model.
    In this form, you should fill:
    - Model name

        Use Camel Case for Model Name
    - Table name (optional)

        Use Snake Case for table name
    - Generate migrations (optional)
    - Generate with form request (optional)
    - Generate with soft delete (optional)
    - Translations (optional)

        Exemples: en,fr
    - Primary key if the primary key is not the id attribute that is added by default (optional)

2. Manage tables models attributes

    To manage tables models attributes, you must click on the view details button corresponding to the table model.
    After that, you will see all attributes of the table model. To add one, click on the plus and green button.

    Attribute properties:
    - Enter attribute name
    - Enter attribute labels (optional)
    - Enter attribute placeholder (optional)
    - Enter attribute laravel validation (optional)

        Example: required
    - Enter attribute Html Type (default: text)
    - Enter attribute database data type (default: string)
    - Enter attribute Data Type Params (optional)

        Examples: 
        - varchar(20) ==> 20
        - double(20,2) ==> 20,2 
    - Enter attribute Options for select, radio, checkbox, ... (optional)

        Example: Male|Female
    - Enter attribute Date format (optional)

        Example: Y-m-d
    - Enter attribute Html Value (optional)
    - Enter attribute CSS class (optional)
    - Enter attribute Data value (optional)

    > PS: It's not allowed to use one of the following symbols in input:

        ; : ,
        