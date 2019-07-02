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
    - Enter attribute Options for select, radio, checkbox, ... (optional)
    - Enter attribute Date format (optional)
    - Enter attribute Html Value (optional)
    - Enter attribute CSS class (optional)
    - Enter attribute Data value (optional)

## Installation

1. To download this package into your laravel project, use the command-line to execute the following command

	```
	composer require pilabrem/laravel-code-generator-ui --dev
	```
 
2. **(You may skip this step when using Laravel >= 5.5)** To bootstrap the packages into your project while using command-line only, open the app/Providers/AppServiceProvider.php file in your project. Then, add the following code to the register() method.

	Add the following line to bootstrap laravel-code-generator to the framework.

	```
	if ($this->app->runningInConsole()) {
	    $this->app->register('Pilabrem\CodeGeneratorUI\CodeGeneratorUiServiceProvider');
	}
	```

## Usages
To manage your tables models, access to [yourHost/code-generator-ui/table].
