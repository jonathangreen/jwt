<?php

namespace Drupal\jwt_auth_refresh\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\jwt_auth_refresh\JwtRefreshTokenInterface;
use Drupal\user\UserInterface;

/**
 * JwtRefreshToken class.
 *
 * @ContentEntityType(
 *   id = "jwt_refresh_token",
 *   label = @Translation("JWT Refresh Token"),
 *   base_table = "jwt_refresh_token",
 *   entity_keys = {
 *     "id" = "id",
 *     "uid" = "uid",
 *     "uuid" = "uuid",
 *   }
 * )
 */
class JwtRefreshToken extends ContentEntityBase implements JwtRefreshTokenInterface {

  /**
   * {@inheritdoc}
   */
  public function isExpired() {
    return $this->get('expires')->getString() < REQUEST_TIME;
  }

  /**
   * Default TTL.
   *
   * One week.
   */
  const TTL = 60 * 60 * 24 * 7;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('User'))
      ->setDescription(t('The associated user.'))
      ->setSetting('target_type', 'user')
      ->setDefaultValueCallback('Drupal\node\Entity\Node::getCurrentUserId')
      ->setDisplayConfigurable('form', TRUE);
    $fields['expires'] = BaseFieldDefinition::create('timestamp')
      ->setCardinality(1)
      ->setLabel(t('Expires'))
      ->setDefaultValueCallback('Drupal\jwt_auth_refresh\Entity\JwtRefreshToken::expires')
      ->setDescription(t('The time the token expires.'));
    return $fields;
  }

  /**
   * Generate default value for the expires time.
   *
   * @return string[]
   *   Array containing the expiration time.
   */
  public static function expires() {
    return [REQUEST_TIME + self::TTL];
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->getEntityKey('uid');
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('uid', $account->id());
    return $this;
  }

}
