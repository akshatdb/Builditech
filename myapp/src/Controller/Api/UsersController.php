<?php
namespace App\Controller\Api;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['add', 'token']);
        $user = $this->Auth->user();
    }
	public function token()
	{	
    $user = $this->Auth->identify();
    if (!$user) {
        throw new UnauthorizedException('Invalid username or password');
    }
    $this->set([
        'success' => true,
        'data' => [
            'token' => JWT::encode([
                'sub' => $user['id'],
                'exp' =>  time() + 604800
            ],
            Security::salt())
        ],
        '_serialize' => ['success', 'data']
    ]);
	}
}