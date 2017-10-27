<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projects Model
 *
 * @property |\Cake\ORM\Association\HasMany $Bookings
 * @property |\Cake\ORM\Association\HasMany $Plots
 *
 * @method \App\Model\Entity\Project get($primaryKey, $options = [])
 * @method \App\Model\Entity\Project newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Project[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Project|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Project[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Project findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectsTable extends Table
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

        $this->setTable('projects');
        $this->setDisplayField('project_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('Plots', [
            'foreignKey' => 'project_id'])->setDependent(true);
        $this->hasMany('Images',[
            'foreignKey' => 'project_id'])->setDependent(true);
        $this->hasMany('Videos',[
            'foreignKey' => 'project_id'])->setDependent(true);
        $this->hasMany('Comments',[
            'foreignKey' => 'project_id'])->setDependent(true);
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
            ->scalar('description');

        $validator
            ->scalar('project_name');

        $validator
            ->scalar('project_addr');

        $validator
            ->scalar('maplat');

        $validator
            ->scalar('maplng');

        $validator
            ->scalar('amount');

        $validator
            ->integer('noplots');

        return $validator;
    }
}
