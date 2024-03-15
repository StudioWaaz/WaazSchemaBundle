<?php
namespace Waaz\SchemaBundle\Structure;

use PHPCR\NodeInterface;
use Sulu\Component\Content\Extension\AbstractExtension;
use Sulu\Component\Content\Extension\ExportExtensionInterface;

class SchemaStructureExtension extends AbstractExtension implements ExportExtensionInterface
{
    /**
    * name of structure extension.
    */
    const OPENGRAPH_EXTENSION_NAME = 'schema';

    protected $properties = [
        'content',
    ];

    protected $name = self::OPENGRAPH_EXTENSION_NAME;

    protected $additionalPrefix = 'schema';

    public function save(NodeInterface $node, $data, $webspaceKey, $languageCode)
    {
        $this->setLanguageCode($languageCode, 'i18n', null);

        $this->saveProperty($node, $data, 'content');
    }

    public function load(NodeInterface $node, $webspaceKey, $languageCode)
    {

        return [
            'content' => $this->loadProperty($node, 'content'),
        ];
    }

    public function export($properties, $format = null)
    {
        $data = [];
        foreach ($properties as $key => $property) {
            $value = $property;
            if (\is_bool($value)) {
                $value = (int) $value;
            }

            $data[$key] = [
                'name' => $key,
                'value' => $value,
                'type' => '',
            ];
        }

        return $data;
    }

    public function import(NodeInterface $node, $data, $webspaceKey, $languageCode, $format)
    {
        $this->setLanguageCode($languageCode, 'i18n', null);

        $this->save($node, $data, $webspaceKey, $languageCode);
    }

    public function getImportPropertyNames()
    {
        return $this->properties;
    }
}