pipeline {
  agent any
  environment {
    staging_server="10.10.10.11"
  }

  stages {
    stage ('Deploy') {
      steps{
        sshagent(['website-inventory']) {
            sh 'ssh -o StrictHostKeyChecking=no bhewe@10.10.10.11'
            sh 'ssh -v bhewe@10.10.10.11'
            sh 'cd ${WORKSPACE}'
            sh 'scp -r ${WORKSPACE} bhewe@${staging_server}:/var/www/'
        }
      }
    }
  }
}