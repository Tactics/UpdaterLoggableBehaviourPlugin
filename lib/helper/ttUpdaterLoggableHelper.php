<?php
/* 
 * Dit bestand maakt deel uit van een applicatie voor Digipolis Antwerpen
 * 
 * (c) 2010 Tactics BVBA
 * 
 * Recht werd verleend om dit bestand te gebruiken als onderdeel van de genoemde
 * applicatie. Mag niet doorverkocht worden, noch rechtstreeks noch via een
 * derde partij. Meer informatie in het desbetreffende aankoopcontract.
 */

function show_last_update($object, $format = "<div class='object_updated_at'>Laatst gewijzigd door %s op %s</div>")
{
  if ($object->getUpdatedAt())
  {
    printf($format,
            $object->getUpdatedByPersoon() ? link_to($object->getUpdatedByPersoon()->getNaam(), '@persoon?id=' . $object->getUpdatedByAccount()->getPersoonId()) : '-onbekend-',
            format_date($object->getUpdatedAt(), 'f'));
  }
}
