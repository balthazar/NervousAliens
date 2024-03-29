module.exports = function(grunt) {

	grunt.initConfig({
		watch: {
			options: {
				livereload: true
			},
			css: {
				files: ['scss/*.scss'],
				tasks: ['compass']
			},
			sass: {
				files: ['sass/*.scss'],
				tasks: ['sass']
			},
			js: {
				files: ['js/*.js']
			},
			php: {
				files: ['index.php', 'php/*.php']
			}
		},
		compass: {
			dist: {
				options: {
					sassDir: 'scss',
					cssDir: 'css'
				}
			}
		},
		sass: {
			dist: {
				files: {
					'css/compiled.css': 'sass/style.scss'
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.registerTask('default', ['watch', 'compass', 'sass']);
};
