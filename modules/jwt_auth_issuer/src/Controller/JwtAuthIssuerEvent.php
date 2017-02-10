<?php

namespace Drupal\jwt_auth_issuer\Controller;

use Drupal\jwt\Authentication\Provider\JwtAuthEvent;

/**
 * Class JwtAuthIssuerEvent.
 *
 * @package Drupal\jwt_auth_issuer\Controller
 */
class JwtAuthIssuerEvent extends JwtAuthEvent {

  /**
   * Adds a claim to a JsonWebToken.
   *
   * @see \Drupal\jwt\JsonWebToken\JsonWebTokenInterface::setClaim()
   */
  public function addClaim($claim, $value) {
    $this->jwt->setClaim($claim, $value);
  }

  /**
   * Removes a claim from a JsonWebToken.
   *
   * @see \Drupal\jwt\JsonWebToken\JsonWebTokenInterface::unsetClaim()
   */
  public function removeClaim($claim) {
    $this->jwt->unsetClaim($claim);
  }

}
