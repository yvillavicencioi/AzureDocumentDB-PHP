>?php 

require_once 'phpdocumentdb.php';
echo "Hola";

$host = 'https://cosmosdb-blog.documents.azure.com:443/';
$master_key = 'ZahzuWWhgW5bWbErLxKKqjOE7VJgW6gzjVnZsJOLrZBT7qZN5St1nBGEiWKfueKWcbasj4adjZhQVjXyQ1rVrQ==';

// connect DocumentDB
$documentdb = new DocumentDB($host, $master_key);

// select Database or create
$db = $documentdb->selectDB("db_test");

// select Collection or create
$col = $db->selectCollection("col_test");

// store JSON document ("id" needed)
$data = '{"id":"1234567890", "FirstName": "Paul","LastName": "Smith"}';
$result = $col->createDocument($data);

// run query
$json = $col->query("SELECT * FROM col_test");

// Debug
$object = json_decode($json);
var_dump($object->Documents);

// get document ResourceID
$json = $col->query("SELECT col_test._rid FROM col_test");
$object = json_decode($json);
var_dump($object->Documents);

// replace document (specify document _rid when created)
$rid = "In4LANe-bbAAAAAAAAAAAA==";
$newData = '{"id":"1234567890", "FirstName": "Jane","LastName": "Doe"}';
echo $col->replaceDocument($rid,$newData);

// delete document (specify document _rid when created)
$rid = "In4LANe-bbAAAAAAAAAAAA==";
echo $col->deleteDocument($rid);

?>
