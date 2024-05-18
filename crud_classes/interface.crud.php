<?php
interface CrudInterface {
    public function create($entity);
    public function getId($id);
    public function update($entity);
    public function delete($id);
}
?>
