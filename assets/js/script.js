document.addEventListener(
    "DOMContentLoaded",
    function () {

        const botoesExcluir =
            document.querySelectorAll(
                ".btn-excluir"
            );

        botoesExcluir.forEach(
            function (botao) {

                botao.addEventListener(
                    "click",
                    function (evento) {

                        const confirmar =
                            confirm(
                                "Tem certeza que deseja excluir este registro?"
                            );

                        if (!confirmar) {

                            evento.preventDefault();

                        }

                    }
                );

            }
        );


        const camposFoto =
            document.querySelectorAll(
                'input[type="file"]'
            );


        camposFoto.forEach(
            function (campo) {

                campo.addEventListener(
                    "change",
                    function () {

                        const arquivo =
                            this.files[0];

                        if (!arquivo) {
                            return;
                        }


                        const tiposPermitidos = [
                            "image/jpeg",
                            "image/png",
                            "image/webp"
                        ];


                        if (
                            !tiposPermitidos.includes(
                                arquivo.type
                            )
                        ) {

                            alert(
                                "Selecione uma imagem JPG, PNG ou WEBP."
                            );

                            this.value = "";

                            return;
                        }


                        const tamanhoMaximo =
                            5 * 1024 * 1024;


                        if (
                            arquivo.size >
                            tamanhoMaximo
                        ) {

                            alert(
                                "A imagem deve ter no máximo 5 MB."
                            );

                            this.value = "";

                        }

                    }
                );

            }

        );

    }
);