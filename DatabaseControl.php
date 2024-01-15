<?php
  class DatabaseControl {
      private $pdo;

      public function __construct($pdo) {
          $this->pdo = $pdo;
      }

      public function fetch($sql, $params = [], $pattern = 'one') {
        switch ($pattern) {
          case 'all':
            return $this->fetchAllData($sql, $params);
            break;
          default:
            return $this->fetchOneData($sql, $params);
            break;
        }
      }

      private function fetchOneData($sql, $params = []) {
        try {
          // パラメータが提供されていればバリデーション
          if (!empty($params) && !is_array($params)) {
              throw new InvalidArgumentException("パラメータは連想配列で提供してください");
          }
          
          $stmt = $this->pdo->prepare($sql);
  
          if (!empty($params) && is_array($params)) {
            // パラメータが提供されていればバインド
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
          }
  
  
          $stmt->execute();
          $result = $stmt->fetch();
  
          return $result;
  
        } catch (Exception $e) {
          // エラーハンドリング
          echo "エラーが発生しました: " . $e->getMessage();
          return [];
        }
      }
  
      private function fetchAllData($sql, $params = []) {
        try {
          // パラメータが提供されていればバリデーション
          if (!empty($params) && !is_array($params)) {
              throw new InvalidArgumentException("パラメータは連想配列で提供してください");
          }
          
          $stmt = $this->pdo->prepare($sql);
  
          if (!empty($params) && is_array($params)) {
            // パラメータが提供されていればバインド
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
          }
  
  
          $stmt->execute();
          $result = $stmt->fetchAll();
  
          return $result;
  
        } catch (Exception $e) {
          // エラーハンドリング
          echo "エラーが発生しました: " . $e->getMessage();
          return [];
        }
      }


      public function insert($sql, $params) {
        // データの挿入処理
        try {
          // パラメータが提供されていればバリデーション
          if (!empty($params) && !is_array($params)) {
              throw new InvalidArgumentException("パラメータは連想配列で提供してください");
          }
          
          $stmt = $this->pdo->prepare($sql);
  
          if (!empty($params) && is_array($params)) {
            // パラメータが提供されていればバインド
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
          }
  
  
          $stmt->execute();
  
        } catch (Exception $e) {
          // エラーハンドリング
          echo "エラーが発生しました: " . $e->getMessage();
          return [];
        }
      }

      public function update($sql, $params) {
          // データの更新処理
          try {
            // パラメータが提供されていればバリデーション
            if (!empty($params) && !is_array($params)) {
                throw new InvalidArgumentException("パラメータは連想配列で提供してください");
            }
            
            $stmt = $this->pdo->prepare($sql);
    
            if (!empty($params) && is_array($params)) {
              // パラメータが提供されていればバインド
              foreach ($params as $key => $value) {
                  $stmt->bindValue($key, $value, PDO::PARAM_STR);
              }
            }
    
    
            $stmt->execute();
    
          } catch (Exception $e) {
            // エラーハンドリング
            echo "エラーが発生しました: " . $e->getMessage();
            return [];
          }
      }
  }