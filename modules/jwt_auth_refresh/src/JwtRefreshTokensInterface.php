<?php

namespace Drupal\jwt_auth_refresh;

use Drupal\Core\Session\AccountInterface;

/**
 * JwtRefreshTokensInterface Interface.
 */
interface JwtRefreshTokensInterface {

  /**
   * Retrieve a refresh token for a user.
   *
   * If a valid token already exists, return it.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The account to for the token.
   *
   * @return \Drupal\jwt_auth_refresh\Entity\JwtRefreshToken
   *   The token.
   */
  public function retrieveForUser(AccountInterface $account);

}
