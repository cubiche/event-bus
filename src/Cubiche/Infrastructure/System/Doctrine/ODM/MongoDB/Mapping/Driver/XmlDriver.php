<?php
/**
 * This file is part of the Cubiche package.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cubiche\Infrastructure\System\Doctrine\ODM\MongoDB\Mapping\Driver;

use Cubiche\Infrastructure\Doctrine\ODM\MongoDB\Mapping\MappingException;
use Cubiche\Infrastructure\Doctrine\ODM\MongoDB\Mapping\Driver\XmlDriver as BaseXmlDriver;
use Cubiche\Infrastructure\Doctrine\ODM\MongoDB\Mapping\PropertyMetadata;
use Metadata\MergeableClassMetadata;

/**
 * XmlDriver class.
 *
 * @author Ivannis Suárez Jerez <ivannis.suarez@gmail.com>
 */
class XmlDriver extends BaseXmlDriver
{
    /**
     * {@inheritdoc}
     */
    protected function addMetadataFor(\SimpleXMLElement $xmlRoot, MergeableClassMetadata $classMetadata)
    {
        $this->addMetadataForEnum($xmlRoot, $classMetadata);
        $this->addMetadataForString($xmlRoot, $classMetadata);
    }

    /**
     * {@inheritdoc}
     */
    protected function addMetadataForEnum(\SimpleXMLElement $xmlRoot, MergeableClassMetadata $classMetadata)
    {
        foreach ($xmlRoot->xpath('//cubiche:enum') as $item) {
            // get the field tag
            $field = $item->xpath('..')[0];
            $fieldMapping = $this->getMappingAttributes($field);
            $fieldName = $fieldMapping['name'];

            $itemMapping = $this->getMappingAttributes($item);
            foreach ($item->attributes() as $key => $value) {
                $itemMapping[$key] = (string) $value;
            }

            if (!isset($itemMapping['type'])) {
                throw MappingException::inField(
                    'The cubiche:enum definition should have a "type" value',
                    $classMetadata->name,
                    $fieldName
                );
            }

            $enumType = $itemMapping['type'];

            if ($field->getName() == 'field') {
                if (isset($fieldMapping['id']) && $fieldMapping['id'] !== false) {
                    throw MappingException::inField(
                        'The cubiche:enum configuration is only for field tags that is not an id',
                        $classMetadata->name,
                        $fieldName
                    );
                }

                if (!isset($fieldMapping['type']) ||
                    (isset($fieldMapping['type']) && $fieldMapping['type'] !== 'CubicheType')
                ) {
                    throw MappingException::inField(
                        'The cubiche:enum parent should have a "type" value equal to CubicheType',
                        $classMetadata->name,
                        $fieldName
                    );
                }

                $propertyMetadata = new PropertyMetadata($classMetadata->name, $fieldName, 'enum');
                $propertyMetadata->setType($enumType);

                $classMetadata->addPropertyMetadata($propertyMetadata);
            } else {
                throw MappingException::inField(
                    'The cubiche:enum configuration is only for id fields',
                    $classMetadata->name,
                    $fieldName
                );
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function addMetadataForString(\SimpleXMLElement $xmlRoot, MergeableClassMetadata $classMetadata)
    {
        foreach ($xmlRoot->xpath('//cubiche:string') as $item) {
            // get the field tag
            $field = $item->xpath('..')[0];
            $fieldMapping = $this->getMappingAttributes($field);
            $fieldName = $fieldMapping['name'];

            if ($field->getName() == 'field') {
                if (isset($fieldMapping['id']) && $fieldMapping['id'] !== false) {
                    throw MappingException::inField(
                        'The cubiche:string configuration is only for field tags that is not an id',
                        $classMetadata->name,
                        $fieldName
                    );
                }

                if (!isset($fieldMapping['type']) ||
                    (isset($fieldMapping['type']) && $fieldMapping['type'] !== 'CubicheType')
                ) {
                    throw MappingException::inField(
                        'The cubiche:string parent should have a "type" value equal to CubicheType',
                        $classMetadata->name,
                        $fieldName
                    );
                }

                $propertyMetadata = new PropertyMetadata($classMetadata->name, $fieldName, 'string');

                $classMetadata->addPropertyMetadata($propertyMetadata);
            } else {
                throw MappingException::inField(
                    'The cubiche:string configuration is only for id fields',
                    $classMetadata->name,
                    $fieldName
                );
            }
        }
    }
}
