<?php

/**
 * @author Gert Vrebos
 * @copyright 2009
 */

class ttUpdaterLoggableBehaviour
{
  /**
   * Save id of the account that created or changed 
   * the object in the created_by or updated_by fields
   */
  public function preSave($object, $con = null)
  {    
    $class = get_class($object);
    $peerClass = $class.'Peer';
    
    if ($object->isNew() || $object->isModified())
    {      
      $accountId = sfContext::getInstance()->getUser()->getAccountId();
  
      if ($object->isNew())
      {
        $object->setCreatedBy($accountId);
      }
  
      if ($object->isModified() && ! $object->isColumnModified(eval('return ' . $peerClass . '::UPDATED_BY;')))
      {
        $object->setUpdatedBy($accountId);
      }
    }     
  }
  
  /**
   * Returns the Account of the creator of the object
   * 
   * @param boolean $joinPersoon default true
   * 
   * @return Account
   */
  public function getCreatedByAccount($object, $joinPersoon = true)
  {
    return $object->getCreatedBy() ? AccountPeer::retrieveByPK($object->getCreatedBy()) : null;
  }

  /**
   * Returns the Account of the latest updator of the object 
   * 
   * @param boolean $joinPersoon default true
   * 
   * @return Account
   */
  public function getUpdatedByAccount($object, $joinPersoon = true)
  {
    return $object->getUpdatedBy() ? AccountPeer::retrieveByPK($object->getUpdatedBy()) : null;
  }
  
  /**
   * Returns the Persoon of the creator of the object
   * 
   * @return Persoon
   */
  public function getCreatedByPersoon($object)
  {
    if ($object->getCreatedBy() && ($account = self::getCreatedByAccount($object)))
    {
      return $account->getPersoon();
    }
    
    return null;
  }

  /**
   * Returns the Persoon of the latest updator of the object 
   * 
   * @return Account
   */
  public function getUpdatedByPersoon($object)
  {
    if ($object->getUpdatedBy() && ($account = self::getUpdatedByAccount($object)))
    {
      return $account->getPersoon();
    }
    
    return null;
  }
  
}