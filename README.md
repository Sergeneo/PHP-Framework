# PHP-Framework

## Start a new project
<br>

> Database connection
```
File: app/Config/App.php
```
<br>

> Install pages routing
```php
// File: app/Config/Routes.php
// Example
// https://website.com/about

$this->route('/about', 'Home/about');

$this->route('/', 'Home/index'); // Default
```
<br>

> Install controllers
```php
// File: app/Controllers/Home.php
// Example

<?php
class Home extends BaseController
{
  public function index()
  {
    $this->view('home_view');
  }

  public function about()
	{
    // Example SQL database
    $query = $this->db->query("INSERT INTO users (name, password) VALUES ('Sergey', 'password')");
    $query = $this->db->query("UPDATE users SET name = 'Sergey'");
    $query = $this->db->query("DELETE FROM users WHERE id = '1'");
    $user = $this->db->fetchRow("SELECT * FROM users WHERE id = '1'");
    $users = $this->db->fetchRows("SELECT * FROM users");

    $data['name'] = 'Hello';
    $this->view('about_view', $data);
  }
}

// Example route
// https://website.com/about/sergey

$this->route('/about/(:any).html', 'Home/about/$1');

// File: app/Controllers/Home.php

<?php
class Home extends BaseController
{
  public function about($name) {
    echo $name; // sergey
  }
}
```
<br>

> Install models
```php
// File: app/Models/HomeModel.php
// Example

<?php
class HomeModel extends BaseController
{
  public function show()
  {
    return "Hello";
  }
}

// Install model in controllers
require_once APP .'/Models/HomeModel.php';
$model = new HomeModel();
$data['text'] = $model->show(); 
```
<br>

> Install views
```php
// File: app/Views/about_view.php
// Example

<?php
$this->view('header_view', [
  'title' => $data['title'], // default 'title' from app/Config/App.php
  'description' => '',
  'header' => '',
]);
?>

<h1 style="padding: 50px; text-align: center;"><?= $data['name']; ?></h1>

<?php
$this->view('footer_view', [
  'footer' => '',
]);
?>
```
