pipeline {
  agent any
  stages {
    stage ('Deploy') {
      steps{
        sshagent(['website-inventory']) {
            sh 'ssh -o StrictHostKeyChecking=no bhewe@10.10.10.11'
            // sh 'ssh -v bhewe@10.10.10.11'
            sh 'scp -r /var/lib/jenkins/workspace/website-inventory/inventory bhewe@10.10.10.11:/var/www'
        }
      }
    }
  }
}