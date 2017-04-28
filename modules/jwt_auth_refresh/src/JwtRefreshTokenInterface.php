<?php

namespace Drupal\jwt_auth_refresh;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * JwtRefreshTokenInterface Interface.
 */
interface JwtRefreshTokenInterface extends ContentEntityInterface, EntityOwnerInterface {

  /**
   * Determine if the token is expired.
   */
  public function isExpired();

}
