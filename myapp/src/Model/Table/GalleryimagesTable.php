<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Galleryimages Model
 *
 * @method \App\Model\Entity\Galleryimage get($primaryKey, $options = [])
 * @method \App\Model\Entity\Galleryimage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Galleryimage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Galleryimage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Galleryimage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Galleryimage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Galleryimage findOrCreate($search, callable $callback = null, $options = [])
 */
class GalleryimagesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('galleryimages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('photo_dir')
            ->allowEmpty('photo_dir');

        $validator
            ->scalar('photo')
            ->allowEmpty('photo');

        return $validator;
    }
}
