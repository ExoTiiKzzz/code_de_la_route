pipeline {
    agent any

    environment {
        gitCredentialId = 'test' //defined in credentials area
        gitUrl = 'https://github.com/ExoTiiKzzz/code_de_la_route.git'
        deployBranch = 'main'
    }

    stages {
        stage('Cloning Git') {
            steps {
                git(
                    url: gitUrl,
                    credentialsId: env.gitCredentialId,
                    branch: deployBranch
                )
            }
        }
    }
}