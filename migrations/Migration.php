<?php 
/**
 * This file is part of Yii2-Wishmaker project
 * (c) kirillantv <http://github.com/kirillantv/>
 * 
 * For more information read README and LICENSE file 
 */
namespace kirillantv\wishmaker\migrations;

use Yii;

class Migration extends \yii\db\Migration 
{
	/**
     * @var string
     */
    protected $tableOptions;
    protected $restrict = 'RESTRICT';
    protected $cascade = 'CASCADE';
    protected $setNull = 'SET NULL';
    protected $dbType;
    

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        switch ($this->db->driverName) {
            case 'mysql':
                $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                $this->dbType = 'mysql';
                break;
            case 'pgsql':
                $this->tableOptions = null;
                $this->dbType = 'pgsql';
                break;
            case 'dblib':
            case 'mssql':
            case 'sqlsrv':
                $this->restrict = 'NO ACTION';
                $this->tableOptions = null;
                $this->dbType = 'sqlsrv';
                break;
            default:
                throw new \RuntimeException('Your database is not supported!');
        }
    }
    
    public function dropColumnConstraints($table, $column)
    {
        $table = $this->db->schema->getRawTableName($table);
        $cmd = $this->db->createCommand('SELECT name FROM sys.default_constraints
                                WHERE parent_object_id = object_id(:table)
                                AND type = \'D\' AND parent_column_id = (
                                    SELECT column_id 
                                    FROM sys.columns 
                                    WHERE object_id = object_id(:table)
                                    and name = :column
                                )', [ ':table' => $table, ':column' => $column ]);
                                
        $constraints = $cmd->queryAll();
        foreach ($constraints as $c) {
            $this->execute('ALTER TABLE '.$this->db->quoteTableName($table).' DROP CONSTRAINT '.$this->db->quoteColumnName($c['name']));
        }
    }
}
?>