<?php
  class DatabaseManager {
      private $pdo;

      public function __construct($pdo) {
          $this->pdo = $pdo;
      }

      public function executeQuery($sql, $params = [], $pattern = 'execute') {
        switch ($pattern) {
          case 'fetchAll':
            return $this->fetchAll($sql, $params);
            break;
          case 'fetchOne':
            return $this->fetchOne($sql, $params);
            break;
          default:
            return $this->execute($sql, $params);
            break;
        }
      }

      public function fetchOne($sql, $params = []) {
        echo $sql;
        var_dump($params);
        try {
          $this->validateParams($params);

          $stmt = $this->pdo->prepare($sql);

          if (!empty($params) && is_array($params)) {
              foreach ($params as $key => $value) {
                  $stmt->bindValue($key, $value, PDO::PARAM_STR);
              }
          }

          $stmt->execute();
          $result = $stmt->fetch();
          echo $result;
          return $result;

        } catch (Exception $e) {
            $this->handleError($e);
            return 0;
        }
      }
  
      private function fetchAll($sql, $params = []) {
        try {
          $this->validateParams($params);

          $stmt = $this->pdo->prepare($sql);

          if (!empty($params) && is_array($params)) {
              foreach ($params as $key => $value) {
                  $stmt->bindValue($key, $value, PDO::PARAM_STR);
              }
          }

          $stmt->execute();
          $result = $stmt->fetchAll();
  
          return $result;

        } catch (Exception $e) {
            $this->handleError($e);
            return 0;
        }
      }


      public function execute($sql, $params) {
        try {
          $this->validateParams($params);

          $stmt = $this->pdo->prepare($sql);

          if (!empty($params) && is_array($params)) {
              foreach ($params as $key => $value) {
                  $stmt->bindValue($key, $value, PDO::PARAM_STR);
              }
          }

          $result = $stmt->execute();
  
          return $result;

        } catch (Exception $e) {
            $this->handleError($e);
            return 0;
        }
      }

      private function validateParams($params) {
        if (!empty($params) && !is_array($params)) {
            throw new InvalidArgumentException("パラメータは連想配列で提供してください");
        }
    }

    private function handleError($e) {
        // 例外をログに書き込んだり、適切にハンドリングする
        echo "エラーが発生しました: " . $e->getMessage();
    }
  }