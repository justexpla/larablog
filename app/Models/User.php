<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @property int id
 * @property string name
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Установка ролей для пользователя
     * @param int $roleId
     * @return $this
     */
    public function setRoles($roleId)
    {
        $this->role()->sync($roleId);

        return $this;
    }

    /**
     * Добавить роль пользователя
     * @param int $roleId
     * @return $this
     */
    public function addRole($roleId)
    {
        $this->role()->attach($roleId);

        return $this;
    }

    /**
     * Удаление роли пользователя
     * @param int $roleId
     * @return $this
     */
    public function deleteRole($roleId)
    {
        $this->role()->detach($roleId);

        return $this;
    }

    /**
     * Проверка роли пользователя
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return ($this->role->where('name', $role)->first()) ? true : false;
    }

    /**
     * Является ли пользователь админом
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Является ли пользователь модератором
     * @return bool
     */
    public function isModerator()
    {
        return $this->hasRole('moderator');
    }

    /**
     * Забанен ли пользователь
     * @return bool
     */
    public function isBanned()
    {
        return $this->hasRole('banned');
    }

    /**
     * Забанить пользователя
     * @return $this
     */
    public function ban()
    {
        $this->addRole(Role::ROLE_BANNED_ID);

        return $this;
    }

    /**
     * Разбанить пользователя
     * @return $this
     */
    public function unban()
    {
        $this->deleteRole(Role::ROLE_BANNED_ID);

        return $this;
    }

    /**
     * Возвращает название роли пользователя. Роль простого пользователя имеет меньший приоритет, чем остальные
     * @return string
     */
    public function getUserRoleLabel()
    {
        $roles = $this->role->except(['id' => Role::ROLE_USER_ID]);

        if ($roles->count()) {
            return $roles->first()->label;
        } else {
            return $this->role->first()->label;
        }
    }

    /**
     * Метод возвращает список пользователей, добавленных в ЧС
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function blackList()
    {
        return $this->hasManyThrough(
            User::class,
            BlackList::class,
            'user_id',
            'id',
            'id',
            'banned_id'
        );
    }

    public function hasOnBlackList(int $bannedUserId)
    {
        return ($this->blackList->find($bannedUserId)) ? true : false;
    }
}
