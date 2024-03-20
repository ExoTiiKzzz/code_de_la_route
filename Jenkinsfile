pipeline {
    agent any

    stages {
        stage('Clone repository') {
            steps {
                git branch: 'main',
                    url: 'https://github.com/ExoTiiKzzz/code_de_la_route.git'
            }
        }

        stage('Run tests') {
            steps {
                sh 'composer test'
            }
        }
    }
}
