<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1535321155PermissionsManagmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions_managments', function (Blueprint $table) {
            if(Schema::hasColumn('permissions_managments', 'ou')) {
                $table->dropColumn('ou');
            }
            
        });
Schema::table('permissions_managments', function (Blueprint $table) {
            
if (!Schema::hasColumn('permissions_managments', 'out')) {
                $table->datetime('out')->nullable();
                }
if (!Schema::hasColumn('permissions_managments', 'back')) {
                $table->datetime('back')->nullable();
                }
if (!Schema::hasColumn('permissions_managments', 'reason')) {
                $table->text('reason')->nullable();
                }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions_managments', function (Blueprint $table) {
            $table->dropColumn('out');
            $table->dropColumn('back');
            $table->dropColumn('reason');
            
        });
Schema::table('permissions_managments', function (Blueprint $table) {
                        $table->datetime('ou')->nullable();
                
        });

    }
}
