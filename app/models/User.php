<?php
    namespace app\models;

    use yii\db\ActiveRecord;
    use Yii;

    class User extends ActiveRecord implements \yii\web\IdentityInterface {

        /**
         * {@inheritdoc}
         */
        public static function findIdentity($id) {
            return static::findOne(['id_user' => $id]);
        }

        /**
         * {@inheritdoc}
         */
        public static function findIdentityByAccessToken($token, $type = null) {

            return null;
        }

        /**
         * Finds user by username
         *
         * @param string $username
         * @return static|null
         */
        public static function findByUsername($username) {

            return static::find() -> where(['username' => $username]) -> one();
        }

        /**
         * {@inheritdoc}
         */
        public function getId() {
            return $this->getPrimaryKey();
        }

        /**
         * {@inheritdoc}
         */
        public function getAuthKey() {
            return $this->auth_key;
        }

        /**
         * {@inheritdoc}
         */
        public function validateAuthKey($authkey) {
            return $this->getAuthKey() === $authkey;
        }

        /**
         * Validates password
         *
         * @param string $password password to validate
         * @return bool if password provided is valid for current user
         */
        public function validatePassword($password) {
            return Yii::$app -> security -> validatePassword($password, $this -> password_hash);
        }

        public function setPassword($password) {
            $this -> password_hash = Yii::$app -> security -> generatePasswordHash($password);
        }

        public function generateAuthKey() {
            $this->auth_key = Yii::$app -> security -> generateRandomString();
        }
    }
?>