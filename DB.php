<?php

class DB
{
    private $conn = null;

    public function getConnection()
    {
        if ($this->conn == null) {
            $this->conn = new PDO("mysql:host=127.0.0.1;dbname=android_notes_2",
                "root",
                "koodinh@");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->conn;
    }

    public function getNotes()
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM notes");
        $stmt->execute();
        try {
            return $stmt->fetchAll();
        } catch (Exception $exception) {
            throw new Exception("Error: " . $exception->getMessage());
        }
    }

    public function getNoteById($id)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM notes WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addNote($title, $content)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("INSERT INTO notes (title, content) VALUES (:title, :content)");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        try {
            $stmt->execute();
        } catch (Exception $exception) {
            var_dump($exception->getTrace());
            return false;
        }
        return true;
    }

    public function updateNote($id, $title, $content)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE notes SET title=:title,content=:content WHERE id=:id");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
        } catch (Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
        return true;
    }

    public function deleteNote($id)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("DELETE FROM notes WHERE id = :id");
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }

}
