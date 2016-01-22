'use strict';
module.exports = function (grunt){
    require("time-grunt")(grunt);
    require('load-grunt-tasks')(grunt);
	  require("rsyncwrapper").rsync;

	 //loading grunt tasks
    grunt.loadNpmTasks('grunt-php');
	  grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
	  grunt.loadNpmTasks('grunt-phplint');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-notify');
    grunt.loadNpmTasks('grunt-bower-task');
    grunt.loadNpmTasks('grunt-rsync');
    grunt.loadNpmTasks('grunt-htmlhint');

 //grunt options
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
           //package options

        compass: {
        	dev: {
            	options: {
              		sassDir: 'custom_assets/style/sass',
              		cssDir: './',
              		fontsDir: 'custom_assets/fonts',
              		javascriptsDir: 'custom_assets/js',
              		imagesDir: 'custom_assets/img',
              		force:true,
              		relativeAssets: true,
            	}
          	}
        },
        jshint:{
        	files: ['Gruntfile.js', 'custom_assets/js/**/*.js'],
        	options: {
            	globals: {
                	jQuery: true
              	}
        	}
        },
        concat: {
        	dev: {
        		src: ['custom_assets/js/Main/*.js' ],
      			dest: 'custom_assets/js/build/dev.js'
    		}
    	},
  		uglify: {
  				target: {
    				src: '<%= concat.dev.dest %>',
    				dest: '../food_truck_production/custom_assets/js/main.min.js'
  				}
		},
		imagemin: {
   				dist: {
      				options: {
        				optimizationLevel: 5
      				},
      				files: [{
         				expand: true,
         				cwd: 'custom_assets/img',
         				src: ['**/*.{png,jpg,gif}'],
         				dest: '../food_truck_production/custom_assets/img'
      				}]
   				}
		},
		phplint:{
        		good: ["test/rsrc/*-good.php"],
        		bad: ["test/rsrc/*-fail.php"]
		},

        htmlhint: {
  			html1: {
    			options: {
    	  			'tag-pair': true
    			},
    			src: ['**/*.php']
  			}
		},
		watch: {
			options: {
            	livereload: true,
            	spawn: false
          	},
        	scripts: {
            	files: ['custom_assets/js/**/*.js'],
            	tasks: ['jshint', 'concat']
          	},
          	compass: {
            	files: ['custom_assets/style/sass/{,*/}*.{scss,sass}'],
            	tasks: ['compass:dev']
          	},
          	php: {
            	files: ['*.php', 'custom_assets/php/{,*/}*.php'],
            	tasks : ['phplint']
          	},
          	html: {
          		files :['**/*.php'],
          		tasks : ['htmlhint']
          	}
        },
		rsync: {
    		options: {
        		args: ["--verbose"],
        		exclude: [".git/*","node_modules",".bowerrc", "bower.json", "livereload.js", "Gruntfile.js", ".sass-cache", 'src', 'Main', 'bootstrap/grunt','bootstrap/js','bootstrap/less','bootstrap/fonts' ,'pro', 'build', ,'package.js', 'LICENSE' ,'package.json', 'Designs', ".smb*"],
        		recursive: true,
    		},
    		dist: {
        		options: {
            		src: "./",
            		dest: "../food_truck_production"
        		}
    		},
		}
	});



    //register tasks here


    grunt.registerTask('go', ['watch', 'compass:dev', 'uglify' ]);

    grunt.registerTask('build-pro', [ 'concat' , 'uglify', 'imagemin', 'rsync:dist']);




}