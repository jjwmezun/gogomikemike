module.exports = function( grunt )
{
	require( "matchdep" ).filterDev( 'grunt-*' ).forEach( grunt.loadNpmTasks );
	
	grunt.initConfig
	({
		pkg: grunt.file.readJSON( 'package.json' ),

		watch:
		{
			css:
			{
				files: [ 'assets/sass/**/*.scss' ],
				tasks: [ 'buildcss' ]
			}
		},
		
		cssc:
		{
			build:
			{
				options:
				{
					consolidateViaDeclarations: true,
					consolidateViaSelectors   : true,
					consolidateMediaQueries   : true
				},
				
				files:
				{
					'style.css': 'style.css'
				}
			}
		},

		
		cssmin:
		{
			build:
			{
				src : 'style.css',
				dest: 'style.css'
			}
		},

		
		sass:
		{
			build:
			{
				files:
				{
					'style.css': 'assets/sass/style.scss'
				}
			}
		}

	});
	
	
	grunt.registerTask( 'buildcss',  [ 'sass', 'cssc', 'cssmin' ] );
	grunt.registerTask( 'default', [] );
	
	
};